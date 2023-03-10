---
path: "/atoms/box/guide"
type: "additionalContent"
level: "atoms"
title: "notification"
---

### Static API

The static API is available under `window.boschFrontendKit.Notification`. Please note that this API is only usable for banner-type notifications.

|  Method | Description  |  
|---|---|
|  `Notification.notificationId(id: string): string`  | Will return the corresponding DOM id for the given notification id, i.e. `frontend-kit-notification-${id}`  | 
|  `Notification.findNotification(id: string): string` | Will find a modal element with the DOM id as returned by `Notification.notificationId` and return the element, if found. |
|  `Notification.showNotification(id)` | Will show the notification identified by the given notification id, if found. |
|  `Notification.hideNotification(id)` | Will hide the notification identified by the given notification id, if found. |

### Instance API

The instance API can be accessed by the `component` property of the notification element.

|  Method | Description  |  
|---|---|
|  `show()` | Will show this notification. |
|  `hide()` | Will hide this notification. |

### Event API

Event handlers can be registered by calling `component.addEventListener(name, callback)`. They can be removed by calling `component.removeEventListener(name, callback)` with the same arguments. Also, `addEventListener` returns an unsubscription function that, once called, achieves the same.

| Event name                                  | Parameters | Description                                         |
| ------------------------------------------- | ---------- | --------------------------------------------------- |
| `private static events = ['closeClicked'];` | _none_     | Will be triggered when the close button is clicked. |
