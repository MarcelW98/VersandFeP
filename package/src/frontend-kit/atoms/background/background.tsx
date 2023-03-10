import * as React from 'react';

interface BackgroundProps {
  type: string;
}

/**
 * @name    a-background
 * @type    background
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 * @description
 * possible variants of background
 */
const Background: React.FunctionComponent<BackgroundProps> = ({ type }) => (
  <div className={`frontend-kit__example-wrapper -${type}`} />
);

export { Background };
export type { BackgroundProps };
