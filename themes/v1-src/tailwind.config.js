let glob = require('glob'),
    path = require('path'),
    plugin = require('tailwindcss/plugin'),
    _ = require('lodash'),
    selectorParser = require('postcss-selector-parser'),

    prefixClass = function (className) {
        const prefix = config('prefix');
        const getPrefix = typeof prefix === 'function' ? prefix : () => prefix;
        return `${getPrefix(`.${className}`)}${className}`;
    },

    pseudoClassVariant = function (pseudoClass) {
        return ({ modifySelectors, separator }) => {
            return modifySelectors(({ selector }) => {
                return selectorParser(selectors => {
                    selectors.walkClasses(classNode => {
                        classNode.value = `${pseudoClass}${separator}${classNode.value}`;
                        classNode.parent.insertAfter(classNode, selectorParser.pseudo({ value: `:${pseudoClass}` }));
                    });
                }).processSync(selector);
            });
        };
    },

    groupPseudoClassVariant = function (pseudoClass) {
        return ({ modifySelectors, separator }) => {
            return modifySelectors(({ selector }) => {
                return selectorParser(selectors => {
                    selectors.walkClasses(classNode => {
                        classNode.value = `group-${pseudoClass}${separator}${classNode.value}`;
                        classNode.parent.insertBefore(classNode, selectorParser().astSync(`.${prefixClass('group')}:${pseudoClass} `));
                    });
                }).processSync(selector);
            });
        };
    }

    module.exports = {
        purge: glob.sync(path.join(__dirname, '**/*.htm')),
        theme: {
            extend: {
                colors: {
                    'royalblue': '#4169E1',
                },
                inset: {
                    '-full': '-100%',
                }
            },
            typography: {
                default: {
                    css: {
                        pre: null,
                        code: null,
                        'code::before': null,
                        'code::after': null,
                        'pre code': null,
                        'pre code::before': null,
                        'pre code::after': null
                    },
                    },
                    },
                    },
                    variants: {
                        inset: ['responsive', 'target'],
                        cursor: ['hover'],
                        display: ['responsive', 'target'],
                        opacity: ['responsive', 'hover', 'focus', 'group-target']
                    },
                    plugins: [
                    require('@tailwindcss/typography'),
                    plugin(function ({addVariant, e}) {
                            addVariant('target', ({modifySelectors, separator}) => {
                                modifySelectors(({className}) => {
                                    return `.${e(`target${separator}${className}`)}:target`
                                })
                            })
                    }),
                        plugin(function ({ addVariant, config }) {

                            const prefixClass = function (className) {
                                const prefix = config('prefix');
                                const getPrefix = typeof prefix === 'function' ? prefix : () => prefix;
                                return `${getPrefix(`.${className}`)}${className}`;
                            };

                            const pseudoClassVariant = function (pseudoClass) {
                                return ({modifySelectors, separator}) => {
                                    return modifySelectors(({selector}) => {
                                        return selectorParser(selectors => {
                                            selectors.walkClasses(classNode => {
                                                classNode.value = `${pseudoClass}${separator}${classNode.value}`;
                                                classNode.parent.insertAfter(classNode, selectorParser.pseudo({value: `.${pseudoClass}`}));
                                            });
                                        }).processSync(selector);
                                    });
                                };
                            };

                            const groupPseudoClassVariant = function (pseudoClass) {
                                return ({modifySelectors, separator}) => {
                                    return modifySelectors(({selector}) => {
                                        return selectorParser(selectors => {
                                            selectors.walkClasses(classNode => {
                                                classNode.value = `group-${pseudoClass}${separator}${classNode.value}`;
                                                classNode.parent.insertBefore(classNode, selectorParser().astSync(`.${prefixClass('group')}:${pseudoClass} `));
                                            });
                                        }).processSync(selector);
                                    });
                                };
                            };

                            addVariant('group-target', groupPseudoClassVariant('target'));
                        })
                    ]
                    }
