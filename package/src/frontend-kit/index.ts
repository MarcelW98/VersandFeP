/**
 * This file contains all logic part of the components
 * The file will be used to load components logic
 * on static sites
 */
import Accordion from './atoms/accordion';
import TextField from './atoms/textField';
import TextArea from './atoms/textArea';
import Checkbox from './atoms/checkbox';
import Box from './atoms/box/index';
import Notification from './atoms/notification/index';
import ProgressIndicator from './atoms/progressIndicator/index';
import ValueModificator from './atoms/valueModificator';
import Rating from './atoms/rating/index';
import Slider from './atoms/slider/index';
import TabNavigation from './atoms/tabNavigation/index';

import Dialog from './molecules/dialog/index';
import Popover from './molecules/popover';
import Lightbox from './molecules/lightbox/index';

import SideNavigation from './molecules/sideNavigation/index';

import ElementWithComponent from './ElementWithComponent';
import WindowWithFrontendKit from './WindowWithFrontendKit';
import FormField from './molecules/formField';
import PageIndicator from './atoms/pageIndicator/index';

import ContextMenu from './organisms/contextMenu/index';
import Header from './organisms/header/index';
import MinimalHeader from './organisms/minimalHeader/index';

/**
 * @WARNING
 * the order of these entries determines the loading order
 * of component behavior code.
 *
 * Keep this in mind when adding components here
 */
const components = [
  {
    Component: Accordion,
    selector: '.a-accordion',
  },
  {
    Component: Checkbox,
    selector: '.a-checkbox',
  },
  {
    Component: Lightbox,
    selector: '.m-lightbox',
  },
  {
    Component: Dialog,
    selector: '.m-dialog',
  },
  {
    Component: Box,
    // here, we only need functionality for modal boxes
    selector: '.a-box--modal',
  },
  {
    Component: Popover,
    // here, we only need functionality for detached popovers
    selector: '.m-popover:not(.-detached)',
  },
  {
    Component: TextField,
    selector: '.a-text-field',
  },
  {
    Component: TextArea,
    selector: '.a-text-area',
  },
  {
    Component: Notification,
    // here, we only need functionality for banner notifications
    selector: '.a-notification--banner',
  },
  {
    Component: ProgressIndicator,
    selector: '.a-progress-indicator',
  },
  {
    Component: FormField,
    selector: '.m-form-field',
  },
  {
    Component: SideNavigation,
    selector: '.m-side-navigation:not(.-detached)',
  },
  {
    Component: Slider,
    selector: '.a-slider',
  },
  {
    Component: PageIndicator,
    selector: '.a-page-indicator',
  },
  {
    Component: ValueModificator,
    selector: '.a-value-modificator',
  },
  {
    Component: TabNavigation,
    selector: '.a-tab-navigation',
  },
  {
    Component: ContextMenu,
    selector: '.o-context-menu',
  },
  {
    Component: Header,
    selector: '.o-header',
  },
  {
    Component: MinimalHeader,
    selector: '.o-minimal-header:not(.-detached)',
  },
  {
    Component: Rating,
    selector: '.a-rating',
  },
];

/**
 * a registry of components that should be published to the
 * global object
 *
 * add any components to be published here
 * @TODO should we just publish all of them somehow?
 */
const componentRegistry = {
  Box,
  Dialog,
  Lightbox,
  Popover,
  Notification,
};

/**
 * prohibit any changes after here to ensure API stability
 */
Object.freeze(componentRegistry);

/**
 * make the registry publically available
 * the guard is there to ensure that this only happens once,
 * because this code may run more than once in e.g. HMR environments
 */
if (!(window as undefined as WindowWithFrontendKit).boschFrontendKit) {
  Object.defineProperty(window, 'boschFrontendKit', {
    get: () => componentRegistry,
  });
}

components.forEach((component) => {
  [...document.querySelectorAll(component.selector)].forEach((element) => {
    if (!(element as ElementWithComponent).component) {
      // eslint-disable-next-line no-new
      new component.Component(element as ElementWithComponent);
    }
  });
});

// // dispatch an event when bootstrapping of frontend-kit is done
const event = new CustomEvent('bosch.frontend-kit-done');
document.dispatchEvent(event);

export default components;
