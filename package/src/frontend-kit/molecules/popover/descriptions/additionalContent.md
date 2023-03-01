---
path: "/molecules/popover/guide"
type: "additionalContent"
level: "molecules"
title: "popover"
---

### Instance API

The instance API can be accessed by the `component` property of the dialog element.

| Method                                                       | description                                                                                                                                                                                                                                                                                                              |
| ------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `attach(target: HTMLElement, moveToContainer?: HTMLElement)` | Will attach this popover to the given target element. If `moveToContainer`is given, the popover will become a childNode of moveToContainer. defaults to `document.body`. If you supply your own container in the second argument, please provide a container with `position: relative` to ensure correct visual display. |
| `show()`                                                     | Will show this popover.                                                                                                                                                                                                                                                                                                  |
| `hide()`                                                     | Will hide this popover.                                                                                                                                                                                                                                                                                                  |
| `setPosition(position: ArrowPosition)`                       | Will set the arrow's position; valid values are `top-left`, `top-center`, `top-right`, `left-top`, `left-center`, `left-bottom`, `bottom-left`, `bottom-center`, `bottom-right`, `right-top`, `right-center` and `right-bottom`.                                                                                         |

### Event API

Event Handlers can be registered by calling `component.addEventListener(name, callback)`. They can be removed by calling `component.removeEventListener(name, callback)` with the same arguments. Also, `addEventListener` returns an unsubscription function that, once called, achieves the same.

| Event Name           | parameters | description                                         |
| -------------------- | ---------- | --------------------------------------------------- |
| `buttonClicked`      | _none_     | Will be triggered when the button is clicked.       |
| `closeButtonClicked` | _none_     | Will be triggered when the close button is clicked. |


