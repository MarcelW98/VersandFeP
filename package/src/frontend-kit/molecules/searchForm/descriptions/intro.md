---
path: "/molecules/searchForm/guide"
type: "intro"
level: "molecules"
title: "search form"
---

A Search form is a search field, wrapped in a `form`, with possible auto-suggestions. For the form to work, you will need to set up either a `name` attribute on the search input and an `action` on the form, or implement your logic in a `submit` event handler on the form.

Attaching autosuggestions heavily depends on your setup and is therefore not part of this component.

<div class="frontend-kit__notification a-notification -warning"><i class="a-icon ui-ic-alert-warning"></i><div class="a-notification__content">
    The autosuggestion list is a markup demonstrator; do not use this implementation in production!
    We recommend to use the `autocomplete="off"` setting showcased here to prevent the browser's native suggestions to overlay the custom suggestions.
</div></div>
