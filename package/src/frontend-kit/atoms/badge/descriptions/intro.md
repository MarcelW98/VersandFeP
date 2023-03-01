---
path: "/atoms/badge/guide"
type: "intro"
level: "atoms"
title: "badge"
---

Badges are used to highlight the characteristics of an object, such as the number of unread messages.

The content (rendered as a string) within the badge can be:

- Text
- Number (no more than three digits recommended)

It comes with three modifiers: `normal` (by default), `warning` and `error`.

Two use-cases are possible for the badge:

- attached to an icon
- as inline badge right next to text

## How to use

It's up to the user how to position the badge relatively to the icon.

As an example, the following steps were taken in the demo below.

1. Have an outer `div` container to wrap the icon and the badge.
2. Give `position: relative` to the outer div.
3. Give `position: absolute` to the badge.
4. Set the position to `top: 8px` and `left: 24px`.
