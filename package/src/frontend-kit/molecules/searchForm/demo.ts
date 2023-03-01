import { dataMock } from './demonstrators/dataMock';

export default (): void => {
  const searchFields = document.querySelectorAll(
    '.a-text-field.a-text-field--search',
  );

  [...searchFields].forEach((searchField) => {
    const searchInput: HTMLInputElement = searchField.querySelector(
      '[type="search"]',
    );
    const resetIcon: HTMLElement = searchField.querySelector(
      '.a-text-field__icon-close',
    );

    // register the reset of the text field input
    if (resetIcon instanceof HTMLElement) {
      resetIcon.addEventListener('click', () => {
        if (searchInput.getAttribute('type') === 'search') {
          searchInput.value = '';
        }
      });
    }
  });

  const exampleContainers = document.querySelectorAll(
    '.frontend-kit-example_m-search-form',
  );

  [...exampleContainers].forEach((container) => {
    const searchField = container.querySelector('.m-search-form');

    searchField.addEventListener('input', (e) => {
      const pastSuggestions = container.querySelector('.a-search-suggestions');
      if (pastSuggestions) {
        pastSuggestions.remove();
      }
      const term = e.target.value;

      const suggestions = [];
      for (let i = 0; suggestions.length < 4 && dataMock.length > i; i += 1) {
        if (dataMock[i].toLowerCase().indexOf(term.toLowerCase()) !== -1) {
          suggestions.push({
            text: dataMock[i],
            highlight: term,
            href: '#',
          });
        }
      }

      const renderSuggestionLinkText = (
        text: string,
        highlight: string,
      ): string => {
        if (!highlight) {
          return text;
        }
        const searchPattern = new RegExp(highlight, 'ig');
        return text.replace(searchPattern, '<em>$&</em>');
      };

      if (suggestions.length) {
        const suggestionItems = suggestions.map((suggestion) => {
          return `
          <li class="a-search-suggestions__item">
            <a href="#" class="a-search-suggestions__result-link">${renderSuggestionLinkText(
              suggestion.text,
              suggestion.highlight,
            )}</a>
          </li>`;
        });
        const suggestionList = `
        <ul class="a-search-suggestions">
          ${suggestionItems.join('')}
          <li class="a-search-suggestions__item a-search-suggestions__results-link">
            <div class="a-link a-link--primary">
              <a href="/" target="_self">All Results</a>
            </div>
          </li>
        </ul>`;
        searchField.insertAdjacentHTML('beforeend', suggestionList);
      }
    });
  });
};
