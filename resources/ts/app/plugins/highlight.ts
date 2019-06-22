import Prism from 'prismjs';

require('prismjs/components/prism-json');
require('prismjs/components/prism-css');
require('prismjs/components/prism-javascript');
require('prismjs/components/prism-less');
require('prismjs/components/prism-sass');
require('prismjs/components/prism-php');
require('prismjs/components/prism-markup');
require('prismjs/components/prism-markup-templating');
require('prismjs/components/prism-bash');

export class Highlight {
  public static highlight() {
    Prism.highlightAll();
  }
}

// Highlight.highlight();

