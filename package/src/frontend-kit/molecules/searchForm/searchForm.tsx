import * as React from 'react';
import {
  SearchSuggestions,
  Suggestion
} from '../../atoms/searchSuggestions/searchSuggestions';
import { TextField } from '../../atoms/textField/textField';

interface SearchFormProps {
  name?: string;
  suggestions?: Suggestion[];
}

const SearchForm: React.FunctionComponent<SearchFormProps> = ({
  name,
  suggestions = [],
}) => (
  <form className="m-search-form" autoComplete="off">
    <TextField
      type="search"
      id={`search-${name ? name.toLowerCase().replace(/\s/g, '-') : null}`}
      placeholder="Search"
      withReset
    />
    {suggestions.length > 0 && <SearchSuggestions suggestions={suggestions} />}
  </form>
);

export { SearchForm };
export type { SearchFormProps };
