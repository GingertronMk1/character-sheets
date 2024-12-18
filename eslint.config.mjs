// @ts-check

import eslint from '@eslint/js';
import tseslint from 'typescript-eslint';
import vueParser from 'vue-eslint-parser';
import pluginVue from 'eslint-plugin-vue';

export default tseslint.config({
    extends: [
        eslint.configs.recommended,
        ...tseslint.configs.strict,
        ...tseslint.configs.stylistic,
        ...pluginVue.configs['flat/recommended'],
    ],
    languageOptions: {
        parser: vueParser,
        parserOptions:
            {
                extraFileExtensions: ['.vue'],
                projectService: true,
                parser: tseslint.parser,
                sourceType: "module",
            }
    },
    files: [
        'resources/**/*.{ts,ts,vue}'
    ],
    ignores: [
        'node_modules/',
        'vendor/'
    ],
    rules: {
        'vue/multi-word-component-names': 'off',
    }
});
