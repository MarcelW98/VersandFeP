---
path: "/molecules/lightbox/guide"
type: "additionalContent"
level: "molecules"
title: "Lightbox"
---

### Static API

The static API is available under `window.boschFrontendKit.Lightbox`.

| Method                                      | description                                                                                                         |
| ------------------------------------------- | ------------------------------------------------------------------------------------------------------------------- |
| `Lightbox.lightboxId(id: string): string`   | Will return the corresponding DOM id for the given lightbox id, i.e. `frontend-kit-lightbox-${id}`                  |
| `Lightbox.findLightbox(id: string): string` | Will find a lightbox element with the DOM id as returned by `Lightbox.lightboxId` and return the element, if found. |
| `Lightbox.showLightbox(id)`                 | Will show the lightbox identified by the given lightbox id, if found.                                               |
| `Lightbox.hideLightbox(id)`                 | Will hide the lightbox identified by the given lightbox id, if found.                                               |

### Instance API

The instance API can be accessed by the `component` property of the lightbox element.

| Method        | parameters      | description                                                                                     |
| ------------- | --------------- | ----------------------------------------------------------------------------------------------- |
| `show()`      |                 | Will show this lightbox.                                                                        |
| `hide()`      |                 | Will hide this lightbox.                                                                        |
| `next(index)` | `index: number` | Will set the next image. Accepts the current index as parameter to determine next image         |
| `back(index)` | `index: number` | Will set the previous image. Accepts the current index as parameter to determine previous image |

### Event API

Event Handlers can be registered by calling `component.addEventListener(name, callback)`. They can be removed by calling `component.removeEventListener(name, callback)` with the same arguments. Also, `addEventListener` returns an unsubscription function that, once called, achieves the same.

| Event Name          | parameters      | description                                                                                                                           |
| ------------------- | --------------- | ------------------------------------------------------------------------------------------------------------------------------------- |
| `closeClicked`      | _none_          | Will be triggered when the close button with the action `close` is clicked.                                                           |
| `next`              | `index: number` | Will be triggered when the button with the action `next` is clicked. Event will come with the current index. Only in sequence variant |
| `back`              | `index: number` | Will be triggered when the button with the action `back` is clicked. Event will come with the current index. Only in sequence variant |
| `backgroundClicked` | _none_          | Will be triggered when the dimmed background (but not the lightbox) is clicked.                                                       |
