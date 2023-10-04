/* eslint-env node */
module.exports = {
    env: {
        browser: true,
        commonjs: true,
        es6: true,
        node: true
    },
    extends: ['eslint:recommended', 'plugin:vue/vue3-recommended', '@vue/eslint-config-prettier'],
    globals: {},
    rules: {
        'vue/require-default-prop': 'off',
        'vue/multi-word-component-names': 'off',
        'vue/no-reserved-component-names': 'off'
    },
    parserOptions: {
        sourceType: 'module',
        ecmaVersion: 2021
    }
}
