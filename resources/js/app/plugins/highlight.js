'use strict';

// import Prism from 'prismjs';

const Prism = require('prismjs');
require('prismjs/components/prism-json');
require('prismjs/components/prism-css');
require('prismjs/components/prism-javascript');
require('prismjs/components/prism-less');
require('prismjs/components/prism-sass');
require('prismjs/components/prism-php');
require('prismjs/components/prism-markup-templating');
require('prismjs/components/prism-bash');

Prism.highlightAllUnder(document.querySelectorAll('pre'));
Prism.highlightAll(true, function () {

});

// module.exports = Prism;
