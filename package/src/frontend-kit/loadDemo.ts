import checkboxDemo from './atoms/checkbox/demo';
import boxDemo from './atoms/box/demo';
import notificationDemo from './atoms/notification/demo';
// import ratingDemo from './atoms/rating/demo';
import progressIndicatorDemo from './atoms/progressIndicator/demo';
import tabbedContentDemo from './atoms/tabNavigation/demo';

import formFieldDemo from './molecules/formField/demo';
import dialogDemo from './molecules/dialog/demo';
import lightboxDemo from './molecules/lightbox/demo';
import popoverDemo from './molecules/popover/demo';
import searchformDemo from './molecules/searchForm/demo';
import sideNavigationDemo from './molecules/sideNavigation/demo';
import stepIndicatorDemo from './molecules/stepIndicator/demo';

import contextMenuDemo from './organisms/contextMenu/demo';
import headerDemo from './organisms/header/demo';
import footerDemo from './organisms/footer/demo';

// construct demos array to call later
const demos: Function[] = [
  checkboxDemo,
  boxDemo,
  dialogDemo,
  lightboxDemo,
  popoverDemo,
  notificationDemo,
  // ratingDemo,
  progressIndicatorDemo,
  formFieldDemo,
  searchformDemo,
  headerDemo,
  footerDemo,
  tabbedContentDemo,
  sideNavigationDemo,
  contextMenuDemo,
  stepIndicatorDemo,
];

// add demo loader to load all given demos
const demoLoader = (): void => demos.forEach((f) => f.call(this));

/**
 * Custom Event "bosch.frontend-kit-done" will fire as soon as
 * the bootstrapping of our Components is done.
 * After the Event fired, demos are safe to be loaded.
 */
document.addEventListener('bosch.frontend-kit-done', demoLoader);
