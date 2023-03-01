import * as React from 'react';
import { Layout } from '../layout';
import { Image, ImageProps } from '../../../../atoms/image/image';

/**
 * @name    Layout
 * @type    basic
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @description
 * example page to show of basic typo usage
 */
const LayoutWithImageDemonstrator: React.FunctionComponent<ImageProps> = ({
  altText,
  caption,
  srcSet,
  defaultSrc,
}) => {
  return (
    <Layout>
      <Image
        srcSet={srcSet}
        defaultSrc={defaultSrc}
        caption={caption}
        altText={altText}
      />
    </Layout>
  );
};

export default LayoutWithImageDemonstrator;
