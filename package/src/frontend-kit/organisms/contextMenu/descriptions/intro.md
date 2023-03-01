---
path: "/organisms/contextMenu/guide"
type: "intro"
level: "organisms"
title: "Context Menu"
---

The context menu offers users additional interactions for an element using a popover and menu items.

## It comes with two types:

- Default (permanently located in one position relative to its button. The popover can only be called here.)
- Free (The Free Context Menu refers to a freely selectable element.)

## Parts

- The popover can be built up by combining different variants of the [menu items](/atoms/menuItem/guide).

## Behaviour

- The navigation can be opened and closed by clicking the trigger menu icon.
- A click on a First Level Page menu item opens the corresponding page.
- Selecting a group opens or closes it, and closes a previous opened group.
- The group's variant on the side will show the sub items on hover.

## How to use the 'Free' Variant

It's up to the user how to position the Free variant relatively to an element.

The demo below used the following position: `top: 0`, `left: 0` along with `z-index: 999`.
