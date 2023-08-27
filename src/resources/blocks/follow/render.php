<?php

use function Roots\bundle;
use function Roots\view;

bundle('block')->enqueueCss();

echo view('block.follow.index')->render();
