---
path: "/molecules/dialog/guide"
type: "additionalContent"
level: "molecules"
title: "Dialog"
---

### Static API

The static API is available under `window.boschFrontendKit.Dialog`.

|  Method | description  |  
|---|---|
|  `Dialog.dialogId(id: string): string`  | Will return the corresponding DOM id for the given dialog id, i.e. `frontend-kit-dialog-${id}`  | 
|  `Dialog.findDialog(id: string): string` | Will find a dialog element with the DOM id as returned by `Dialog.dialogId` and return the element, if found. |
|  `Dialog.showDialog(id)` | Will show the dialog identified by the given dialog id, if found. |
|  `Dialog.hideDialog(id)` | Will hide the dialog identified by the given dialog id, if found. |

### Instance API

The instance API can be accessed by the `component` property of the dialog element.

|  Method | description  |  
|---|---|
|  `show()` | Will show this dialog. |
|  `hide()` | Will hide this dialog. |

### Event API

Event Handlers can be registered by calling `component.addEventListener(name, callback)`. They can be removed by calling `component.removeEventListener(name, callback)` with the same arguments. Also, `addEventListener` returns an unsubscription function that, once called, achieves the same.

|  Event Name | parameters  |  description |
|---|---|--|
|  `confirmed` | _none_ | Will be triggered when the button with the action `confirm` is clicked. |
|  `canceled` | _none_ | Will be triggered when the button with the action `cancel` is clicked. |
|  `closeClicked` | _none_ | Will be triggered when the button with the action `close` is clicked. |
|  `backgroundClicked` | _none_ | Will be triggered when the dimmed background (but not the dialog) is clicked. |


