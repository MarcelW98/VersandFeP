import * as React from 'react';
import { Accordion } from '../accordion';

interface MultiAccordionProps {
  size?: 'small' | 'large';
}

const MultiAccordionDemonstrator: React.FunctionComponent<MultiAccordionProps> =
  ({ size = 'large' }) => {
    return (
      <>
        <Accordion size={size} headline="Accordion Headline 1" />
        <Accordion size={size} headline="Accordion Headline 2" />
        <Accordion size={size} headline="Accordion Headline 3" />
        <Accordion size={size} headline="Accordion Headline 4" />
      </>
    );
  };

export default MultiAccordionDemonstrator;
