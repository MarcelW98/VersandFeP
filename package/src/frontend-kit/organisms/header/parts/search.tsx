import * as React from 'react';
import { Button } from '../../../atoms/button/button';
import { SearchForm } from '../../../molecules/searchForm/searchForm';

const Search: React.FunctionComponent = () => (
  <div className="o-header__search">
    <SearchForm />
    <Button
      mode="integrated"
      additionalClasses={['o-header__search-open']}
      label="Search"
      icon="search"
      aria-haspopup="true"
      aria-expanded="false"
    />
  </div>
);

export default Search;
