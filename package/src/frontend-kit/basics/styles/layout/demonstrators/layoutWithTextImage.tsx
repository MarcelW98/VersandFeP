import * as React from 'react';
import { Layout } from '../layout';
import {
  TextImage,
  TextImageProps,
} from '../../../../molecules/textImage/textImage';

/**
 * @name    Layout
 * @type    basic
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @description
 * example page to show of basic typo usage
 */
const LayoutWithTextImageDemonstrator: React.FunctionComponent<TextImageProps> = ({
  headingText,
  image,
  paragraph,
}) => {
  return (
    <Layout>
      <TextImage
        order="default"
        headingText={headingText}
        image={image}
        paragraph={paragraph}
      />
    </Layout>
  );
};

export default LayoutWithTextImageDemonstrator;
