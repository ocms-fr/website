<?php namespace SunLab\Newsletter\Models;

use Model;
use October\Rain\Database\Builder;
use October\Rain\Exception\ApplicationException;
use SunLab\Newsletter\Classes\MailService;
use SunLab\Newsletter\Plugin;

/**
 * @method static waitingForAnEmail()
 * @param October\Rain\Database\Builder $query
 * @return \Illuminate\Database\Query\Builder
 */

class Subscriber extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'sunlab_newsletter_subscribers';

    public $rules = [];

    protected $guarded = [];

    public $belongsToMany = [];

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        try {
            $this->belongsToMany = [
                'categories' => array_merge(
                    Plugin::getActivatedPlugin()::getCategoryRelationship(),
                    ['table' => 'sunlab_newsletter_subscribers_categories']
                )
            ];
        } catch (ApplicationException $e) {
            \Log::error($e);
            abort(500, $e);
        }
    }

    public function scopeWaitingForAnEmail(Builder $query)
    {
        return $query
            ->select()
            ->selectRaw("EXTRACT(DAY FROM AGE(CURRENT_TIMESTAMP, last_sended_at))::INTEGER AS waiting_since")
            ->where('frequency', '!=', 0)
            ->whereRaw("
                AGE(CURRENT_TIMESTAMP, last_sended_at) > (frequency || ' days')::INTERVAL
            ");
    }

    public function afterCreate()
    {
        MailService::sendSubscriptionMail($this->email);
    }

    public function afterDelete()
    {
        MailService::sendUnsubscriptionMail($this->email);
    }
}
