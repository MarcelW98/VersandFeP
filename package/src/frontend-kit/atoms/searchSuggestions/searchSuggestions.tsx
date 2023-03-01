import * as React from 'react';
import { Link } from '../link/link';

interface Suggestion {
  text: string;
  highlight: string;
  href: string;
}

interface SearchSuggestionsProps {
  suggestions: Suggestion[];
}

const renderSuggestionLinkText = (text: string, highlight: string): string => {
  if (!highlight) {
    return text;
  }
  return text.replace(highlight, `<em>${highlight}</em>`);
};

const SearchSuggestions: React.FunctionComponent<SearchSuggestionsProps> = ({
  suggestions = [],
}) => (
  <ul className="a-search-suggestions">
    {suggestions.map((suggestion, index) => (
      <li className="a-search-suggestions__item" key={index}>
        <a
          href={suggestion.href}
          className="a-search-suggestions__result-link"
          /* eslint-disable-next-line react/no-danger */
          dangerouslySetInnerHTML={{
            __html: renderSuggestionLinkText(
              suggestion.text,
              suggestion.highlight,
            ),
          }}
          tabIndex={-1}
        >
          {}
        </a>
      </li>
    ))}
    <li className="a-search-suggestions__item a-search-suggestions__results-link">
      <Link label="All Results" level="primary" href="/" tabIndex={-1} />
    </li>
  </ul>
);

export { SearchSuggestions };
export type { SearchSuggestionsProps, Suggestion };
