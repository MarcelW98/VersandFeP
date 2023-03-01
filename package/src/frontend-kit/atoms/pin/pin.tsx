import * as React from 'react';
import classNames from 'classnames';

import { Icon } from '../icon/icon';

class PinProps {
  isDisabled?: boolean;
  isCluster?: boolean;
  clusterLabel?: number;
}

/**
 * @name        a-pin
 * @type        atom
 * @author      Experience One AG
 * @copyright   Robert Bosch GmbH
 *
 * @param       {boolean}   isDisabled    Wether or not the pin is disabled
 * @param       {boolean}   isCluster     Wether or not the pin is a cluster
 * @param       {number}    clusterLabel  Label to display on a cluster pin
 * @description
 * representation of pins
 */

const Pin: React.FunctionComponent<PinProps> = ({
  isDisabled,
  isCluster,
  clusterLabel,
}: PinProps) => {
  const pinClass = classNames('a-pin', {
    'a-pin--cluster': isCluster,
    '-disabled': isDisabled,
  });

  return (
    <div className={pinClass}>
      {isCluster === true ? clusterLabel : <Icon iconName="pin" titleText="lorem ipsum"/>}
    </div>
  );
};

export { Pin, PinProps };
