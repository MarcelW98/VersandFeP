---
path: "/atoms/textField/guide"
type: "intro"
level: "atoms"
title: "text field"
---

The text field element can be used for single-line input. It features an optional `label` and an optional placeholder as well as success, error and warning states.

The password variant features a control that will show the password to the user. Note that this will not have any impact on the data transmitted.

See [Form](/organisms/form/guide) for example usage in a form.

<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
    In order for the <code>label</code> to work correctly, the <code>input</code> tag needs a unique <code>id</code> attribute and the <code>label</code> tag needs the same <code>for</code> attribute.
</div></div>
<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
According to the <a href="https://www.w3.org/WAI/standards-guidelines/wcag/" target="_self">Web Content Accessibility Guidelines (WCAG)</a>, it is highly reccomended to use together with the text field a label.
</div></div>