---
path: "/molecules/formField/guide"
type: "additionalContent"
level: "molecules"
title: "Form field"
---

### Instance API

The instance API can be accessed by the `component` property of the dialog element.

| Method                                                            | description                                                                                                                                                                                                                                                        |
| ----------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `setState(`<br>`state: string,`<br>`notification?: string`<br>`)` | Set the new state, updates icon and colors. If `notification` is given, adds a text notification.<br><br>`state` can only be one of `'neutral'`, `'success'`, `'warning'` or `'error'`.<br><br>Call `setState('neutral')` to clear the state and the notification. |
