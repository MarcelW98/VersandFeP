'use strict';

angular.module('DigLief.version', [
  'DigLief.version.interpolate-filter',
  'DigLief.version.version-directive'
])

.value('version', '0.1');
