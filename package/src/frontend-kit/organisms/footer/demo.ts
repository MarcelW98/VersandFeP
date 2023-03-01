export default (): void => {
  // every button with the right class will show the "demo" modal on click
  // Exclude from selection the footers (those with class '-minimal') without an input inside
  const footers = Array.from(
    document.querySelectorAll('.o-footer:not(.-minimal)'),
  );

  footers.forEach((footer) => {
    const input = footer.querySelector('input');

    let addSuggestionTimeout: ReturnType<typeof setTimeout> = null;

    input.addEventListener('focus', () => {
      addSuggestionTimeout = setTimeout(() => {
        footer.classList.add('-show-suggestions');
      }, 1000);
    });

    input.addEventListener('blur', () => {
      clearTimeout(addSuggestionTimeout);
      footer.classList.remove('-show-suggestions');
    });
  });
};
