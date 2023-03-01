import * as React from 'react';
import MinimalHeader from '../minimalHeader';

import * as headerConfiguration from '../data.json';
import * as textImageConfiguration from '../../../molecules/textImage/data.json';
import {
  TextImage,
  TextImageProps,
} from '../../../molecules/textImage/textImage';

const MinimalHeaderWithContentDemonstrator: React.FunctionComponent = () => {
  // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
  const props = headerConfiguration.default!;
  const {
    order,
    headingText,
    image,
    paragraph,
    // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
  } = textImageConfiguration.default! as TextImageProps;
  const textImageProps: TextImageProps = {
    order,
    headingText,
    image,
    paragraph,
  };

  return (
    <>
      {/* eslint-disable-next-line react/jsx-props-no-spreading */}
      <MinimalHeader {...props} />
      <div className="e-container">
        <main style={{ paddingTop: '6rem' }}>
          {/* eslint-disable-next-line react/jsx-props-no-spreading */}
          <TextImage {...textImageProps} />
        </main>
      </div>
    </>
  );
};

export default MinimalHeaderWithContentDemonstrator;
