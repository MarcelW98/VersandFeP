const has = (header: Element, className: string): boolean =>
  header.classList.contains(className);
const add = (header: Element, className: string): void =>
  header.classList.add(className);
const remove = (header: Element, className: string): void =>
  header.classList.remove(className);

export default (): void => {
  // every button with the right class will show the "demo" modal on click
  const headers = Array.from(document.querySelectorAll('.o-header'));

  headers.forEach(header => {
    let addSuggestionTimeout: ReturnType<typeof setTimeout> = null;

    const observer = new MutationObserver(() => {
      if (
        has(header, '-search-open') &&
        !has(header, '-show-suggestions') &&
        addSuggestionTimeout === null
      ) {
        addSuggestionTimeout = setTimeout(() => {
          add(header, '-show-suggestions');
          addSuggestionTimeout = null;
        }, 1000);
      }

      if (!has(header, '-search-open') && has(header, '-show-suggestions')) {
        remove(header, '-show-suggestions');
      }
    });

    observer.observe(header, {
      attributes: true,
    });
  });
};
