---
path: "/atoms/box/guide"
type: "variant"
level: "atoms"
title: "box"
variant: "modal box"
---

A modal box will cover the whole screen and dim the background, so the content is the only thing remaining in the user's focus. Find the code for this example below.

<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
    On page load, modal box components will move to the end of the DOM automatically. This is needed to ensure the fullscreen display.
</div></div>

<div
  class="frontend-kit__notification a-notification -warning"
  role="alert"
  aria-labelledby="notification-box-disclaimer-modal-function"
>
  <i class="a-icon ui-ic-alert-warning" title="warning"></i>
  <div id="notification-box-disclaimer-modal-function" class="a-notification__content">
    Be aware that the modal box will <strong>not</strong> handle multiple modal boxes on the website. To decide which modal box is visible, is hidden or is on top of an other modal box, needs to be done by user implementation.
  </div>
</div>
