---
path: "/atoms/box/guide"
type: "intro"
level: "atoms"
title: "button"
---

Buttons come in four variations: `primary`, `secondary`, `tertiary` and `close`.

The first three variations allow for an icon and a label, with either optional. To ensure correct display, use the `-without-label` and `-without-icon` classes when omitting the label or icon, respectively.

A helper class `-fixed` helps with buttons that have a fixed width.

Buttons do not bring any margins, but should have a spacing of `16px` between them. For an example, see [Dialog](/molecules/dialog/guide).

You can consider using the `data-frok-action` attribute to convey the semantic meaning of the button. See the [Dialog](/molecules/dialog/guide) component for an example.

<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
    For accessibility reasons, do not use <code>a</code> tags for buttons!
</div></div>
