---
path: "/atoms/valueModificator/guide"
type: "intro"
level: "atoms"
title: "value modificator"
---

The value modificator element can be used for numeric input. It features an optional `label` as well as success, error and warning states.

The plus and minus icons on the right allow to move the value up or down by the step size.

Min and max attributes can also be defined to limit the range of allowed input.

<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
    In order for the <code>label</code> to work correctly, the <code>input</code> tag needs a unique <code>id</code> attribute and the <code>label</code> tag needs the same id for the <code>for</code> attribute.
</div></div>
<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
According to the <a href="https://www.w3.org/WAI/standards-guidelines/wcag/" target="_self">Web Content Accessibility Guidelines (WCAG)</a>, it is highly reccomended to use together with the value modificator a label.
</div></div>