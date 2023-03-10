import * as React from 'react';

interface TextProps {
  content: {
    headline?: {
      level: number;
      content: string;
    };
    paragraph?: string[];
    caption?: string[];
  }[];
}

/**
 * @name    a-text
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {array} content   Array of content which should be rendered
 * @description
 * representation of text like headline and paragraphs
 */
const Text: React.FunctionComponent<TextProps> = ({ content }) => (
  <div className="a-text">
    {content.map(({ headline = null, paragraph = [], caption = [] }, index) => {
      let CustomTag;

      if (headline) {
        // build custom tag for dynamic usage of headlines
        CustomTag = `h${headline.level}`;
      }

      return (
        <React.Fragment key={`fragment-${index + 1}`}>
          {headline && (
            <CustomTag key={`headline-${index + 1}`}>
              {headline.content}
            </CustomTag>
          )}
          {paragraph &&
            paragraph.map((text) => (
              <p
                key={`para-${index + 1}`}
                dangerouslySetInnerHTML={{ __html: text }}
              />
            ))}
          {caption &&
            caption.map((text) => (
              <p
                key={`caption-${index + 1}`}
                className="a-text__caption"
                dangerouslySetInnerHTML={{ __html: text }}
              />
            ))}
        </React.Fragment>
      );
    })}
  </div>
);

export { Text };
export type { TextProps };
