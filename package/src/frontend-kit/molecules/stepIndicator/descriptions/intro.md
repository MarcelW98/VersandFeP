---
path: "/molecules/stepIndicator/guide"
type: "intro"
level: "molecules"
title: "Step indicator"
---

A step indicator is useful to show the use the current step of a procedure, e.g. split up form fields at a registration.

The Step indicator comes in three variants:

- numbered steps and label
- icons as steps and label
- small steps, which have no number or icon, and label
- small steps, which have no number or icon, and without label

The last variant of small items without label, is very useful on smaller viewports.

<div class="frontend-kit__notification a-notification -neutral">
  <i class="a-icon ui-ic-alert-info"></i>
  <div class="a-notification__content">
    When using the numbered steps, the maximum number should not pass 99.
  </div>
</div>

## small variant

To use the small variant, the modifier class `-small` needs to be put on the most outer container of the step indicator `m-step-indicator`

## active steps

To active a step, the modifier class `-active` needs to be put on the related step `m-step-indicator__step`
