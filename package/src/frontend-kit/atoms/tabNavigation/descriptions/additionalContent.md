---
path: "/atoms/tabNavigation/guide"
type: "additionalContent"
level: "atoms"
title: "tab navigation"
---

### Event API

Event Handlers can be registered by calling `component.addEventListener(name, callback)`. They can be removed by calling `component.removeEventListener(name, callback)` with the same arguments. Also, `addEventListener` returns an unsubscription function that, once called, achieves the same.

| Event Name | parameters   | description                                                                                                                |
| ---------- | ------------ | -------------------------------------------------------------------------------------------------------------------------- |
| `selected` | `id: string` | Will be triggered when the active tab changes. `id` is the identifier given with the `data-frok-tab-identifier` attribute. |

