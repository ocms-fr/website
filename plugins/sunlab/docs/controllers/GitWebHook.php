<?php namespace SunLab\Docs\Controllers;

use October\Rain\Exception\ApplicationException;
use October\Rain\Filesystem\Zip;
use RainLab\Docs\Controllers\Index;
use SunLab\Docs\Models\Settings;
use File;
use Markdown;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class GitWebHook extends Index
{
    protected $repositoryName;

    protected $branch;

    protected $repositoryAuthor;

    /**
     * Handle the GitHub webhook request
     * @param string $hashKey
     */
    public function refresh($hashKey)
    {
        $settings = Settings::instance();
        $this->repositoryAuthor = strtolower($settings->repositoryAuthor);
        $this->repositoryName = strtolower($settings->repositoryName);

        if ($hashKey !== $settings->hashKey) {
            return redirect('404');
        }

        try {
            if (
                $settings->repositoryName !== strtolower(input('repository.name'))
                ||
                $settings->repositoryAuthor !== strtolower(input('repository.owner.login'))
            ) {
                throw new ApplicationException('Settings did not correspond the payload\'s owner and name.');
            }

            $this->docsRepoZip = 'https://github.com/' .
                                    $settings->repositoryAuthor . '/' . $this->repositoryName .
                                    '/archive/' . $settings->branch . '.zip';

            // Process the update using RainLab\Docs controller's methods
            $this->downloadUpdates();

            $this->extractUpdates();

            $this->renderDocs();

            return response('Update done');
        } catch (ApplicationException $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Extracts the documentation from the repository ZIP file.
     *
     * @return void
     */
    protected function extractUpdates()
    {
        $tempPath = $this->getTempDirectory() . '/' . 'docs-repo.zip';
        $destFolder = $this->tempDirectory . '/' . $this->repositoryName . '-' . $this->branch;

        // Remove old extract folder if it exists
        if (File::exists($destFolder)) {
            File::deleteDirectory($destFolder);
        }

        if (!Zip::extract($tempPath, $destFolder)) {
            throw new ApplicationException(Lang::get('rainlab.docs::lang.updates.extractFailed', [
                'file' => $tempPath
            ]));
        }

        @unlink($tempPath);
    }

    /**
     * Renders the documentation as HTML files.
     *
     * This will iterate through the Markdown documents from the documentation repository and render each one as
     * an HTML file for display in the documentation area.
     *
     * It will also move other files (ie. configuration and images) into their specific folders.
     *
     * @return void
     */
    protected function renderDocs()
    {
        $renderDir = $this->getRenderDirectory();
        $tempFolder = $this->getTempDirectory() . '/' . $this->repositoryName . '-' . $this->branch;

        // Clear out old rendered docs
        if (count(File::files($renderDir)) > 0) {
            File::deleteDirectory($renderDir, true);
        }

        $files = (is_dir($tempFolder))
            ? new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tempFolder))
            : [];

        foreach ($files as $file) {
            // YAML files - structure and menus
            if (File::isFile($file) && File::extension($file) === 'yaml') {
                if (!File::exists($renderDir . '/config')) {
                    File::makeDirectory($renderDir . '/config', 0777, true);
                }

                File::move($file, $renderDir . '/config/' . File::basename($file));
            }

            // Image files
            if (File::isFile($file) && in_array(File::extension($file), ['jpg', 'jpeg', 'png', 'gif'])) {
                if (!File::exists($renderDir . '/images')) {
                    File::makeDirectory($renderDir . '/images', 0777, true);
                }

                File::move($file, $renderDir . '/images/' . File::basename($file));
            }

            // Markdown files - documentation content
            if (File::isFile($file) && File::extension($file) === 'md') {
                $filename = File::name($file);
                $html = Markdown::parse(File::get($file));
                File::put($renderDir . '/' . $filename . '.html', $html);
            }
        }

        // Remove temp folder
        File::deleteDirectory($tempFolder);
    }

    /**
     * Gets the directory that will store the rendered Markdown files.
     *
     * If the directory does not exist, it will be created.
     *
     * @return string
     */
    protected function getRenderDirectory()
    {
        $renderDirectory = storage_path('/app/docs/' . $this->repositoryAuthor . '/' . $this->repositoryName . '/');

        if (!File::isDirectory($renderDirectory)) {
            File::makeDirectory($renderDirectory, 0777, true);
        }

        return $this->renderDirectory = $renderDirectory;
    }
}
