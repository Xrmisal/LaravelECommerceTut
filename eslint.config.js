import globals from "globals";
import pluginVue from "eslint-plugin-vue";
import { defineConfig } from "eslint/config";

export default defineConfig([
  { 
    files: ["**/*.{js,mjs,cjs,vue}"], languageOptions: { globals: globals.browser } 
  },
  {
    "vue/multi-word-component-names": "off"
  },
  pluginVue.configs["flat/essential"],
]);
