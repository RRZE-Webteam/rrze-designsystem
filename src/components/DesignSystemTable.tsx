import React from 'react';

/**
 * Type definition for DesignSystemTableProps.
 * Represents properties for the DesignSystemTable component.
 *
 * @typedef {Object} DesignSystemTableProps
 * @property {JSX.Element} example - The example JSX to render within the table.
 * @property {string} tokenName - The name of the token.
 * @property {string} value - The color value associated with the token.
 * @property {string} useCase - The use case for the color.
 * @property {string} copy - The copy text or icon.
 * @property {string} jumpLink - The jump link for the table row.
 */
type DesignSystemTableProps = {
  example: JSX.Element;
  tokenName: string;
  value: string;
  useCase: string;
  copy: string;
  jumpLink: string;
};

/**
 * DesignSystemTable component.
 * Renders a table row representing a design token.
 *
 * @param {DesignSystemTableProps} props - Component properties.
 * @returns {JSX.Element} Rendered DesignSystemTable component.
 */
const DesignSystemTable = ({
  example,
  tokenName,
  value,
  useCase,
  copy,
  jumpLink,
}: DesignSystemTableProps) => {
  return (
    <tr id={tokenName} className="light color">
      <td data-label="Example">
        {example}
      </td>
      <td data-label="Token name">
        <code>{tokenName}</code>
      </td>
      <td data-label="Value">
        <code>{value}</code>
      </td>
      <td data-label="Use case">
        {useCase}
      </td>
      <td data-label="Copy">
        <div dangerouslySetInnerHTML={{ __html: copy }} />
      </td>
    </tr>
  );
};

export {DesignSystemTable};
