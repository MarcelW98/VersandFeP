---
path: "/atoms/box/guide"
type: "additionalContent"
level: "atoms"
title: "box"
---

### Static API

The static API is available under `window.boschFrontendKit.Box`.

|  Method | description  |  
|---|---|
|  `Box.modalId(id: string): string`  | Will return the corresponding DOM id for the given modal id, i.e. `frontend-kit-modal-${id}`  | 
|  `Box.findModal(id: string): string` | Will find a modal element with the DOM id as returned by `Box.modalId` and return the element, if found. |
|  `Box.showModal(id)` | Will show the modal identified by the given modal id, if found. |
|  `Box.hideModal(id)` | Will hide the modal identified by the given modal id, if found. |

### Instance API

The instance API can be accessed by the `component` property of the modal element.

|  Method | description  |  
|---|---|
|  `show()` | Will show this modal. |
|  `hide()` | Will hide this modal. |
|  `isModal()` | Will return true if this a modal box, false otherwise. |

### Event API

Event Handlers can be registered by calling `component.addEventListener(name, callback)`. They can be removed by calling `component.removeEventListener(name, callback)` with the same arguments. Also, `addEventListener` returns an unsubscription function that, once called, achieves the same.

|  Event Name | parameters  |  description |
|---|---|--|
|  `backgroundClicked` | _none_ | Will be triggered when the dimmed background (but not the box) is clicked. |


