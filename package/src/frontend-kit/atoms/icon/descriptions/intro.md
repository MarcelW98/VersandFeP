---
path: "/atoms/icon/guide"
type: "intro"
level: "atoms"
title: "icon"
---

Icons use the Bosch icon font and are controlled by CSS classes. See the table below for icon names and the HTML markup for how to use them.
The font can be downloaded from the [Bosch Brand Guide](https://brandguide.bosch.com/document/79#/schrift-typografie/bosch-icon).

The implemented ui-icon-font version is <strong class="bosch-ui-ic-version">&nbsp;</strong>.
<br>
The implemented icon-font version is <strong class="bosch-ic-version">&nbsp;</strong>.

<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
    Keep in mind that the icon font file may fail to load and thus, render icons invisible or unrecognizable. For important functional elements (like close buttons), do not use the icon font, or at least not <em>only</em> the icon font
</div></div>

## How to use

1. copy the base code snippet for one icon from here
1. look up the icon you want to use
1. copy the name of the icon
1. adjust the class of the `<i></i>` tag
   - base name: **a-icon**
   - generic bosch ui-icon name: **ui-ic-**
   - generic bosch icon name: **boschicon-bosch-ic-**
   - replace the last part of the class name with the icon name: **emoji-happy**

<i class="a-icon boschicon-bosch-ic-emoji-happy"></i>

### Icon types

#### Default icons 

Default icon behavior and layout.

**Prefix:** *ui-ic-*

#### Inline icons 

Icons optimized for inline usage

**Prefix:** *ui-ic-inline-*


#### Icons without save area

Icons that use the maximum area in the symbol

**Prefix:** *ui-ic-nosave-*
