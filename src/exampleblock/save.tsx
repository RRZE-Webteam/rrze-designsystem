import { useBlockProps } from "@wordpress/block-editor";
import { DesignSystemTable } from "../components/DesignSystemTable";

interface Category {
  term_id: number;
  name: string;
  slug: string;
  term_group: number;
  term_taxonomy_id: number;
  taxonomy: string;
  description: string;
  parent: number;
  count: number;
  filter: string;
}

interface ColorSystem {
  id: number;
  title: string;
  hex_value: string;
  color_name: string;
  color_type: string;
  category: Category[];
}

interface SaveProps {
  attributes: {
    style?: string;
    color: string;
    textColor?: string;
    borderColor?: string;
    title?: string;
    selectedCategories: { [key: string]: boolean };
    groupedColors: { [key: string]: ColorSystem[] };
  };
}

export default function Save({ attributes }: SaveProps) {
  const props = useBlockProps.save();

  const a11y_color_on_background = (color: string) => {
    const colorValue = color.replace("#", "");
    const r = parseInt(colorValue.substr(0, 2), 16);
    const g = parseInt(colorValue.substr(2, 2), 16);
    const b = parseInt(colorValue.substr(4, 2), 16);
    const brightness = (r * 299 + g * 587 + b * 114) / 1000;
    return brightness >= 128 ? "#000000" : "#ffffff";
  };

  return (
    <div {...props}>
      <div>
        <h3>Available Color Systems</h3>
        {Object.keys(attributes.groupedColors).length > 0 ? (
          Object.keys(attributes.groupedColors)
            .filter((categoryName) =>
              attributes.selectedCategories
                ? attributes.selectedCategories[categoryName]
                : true
            )
            .map((categoryName) => (
              <div key={categoryName}>
                <h4>{categoryName}</h4>
                <ul className="rrze-designsystem-colorlist">
                  {attributes.groupedColors[categoryName].map((item) => (
                    <li
                      key={item.id}
                      style={{
                        backgroundColor: item.hex_value,
                        color: a11y_color_on_background(item.hex_value),
                      }}
                    >
                      <strong>{item.title}</strong> - {item.color_name} (
                      {item.hex_value})
                    </li>
                  ))}
                </ul>
              </div>
            ))
        ) : (
          <p>No color systems found.</p>
        )}
      </div>
      <table>
        <thead>
          <tr>
            <th scope="col" data-label="Example">
              <abbr title="Example">Ex.</abbr>
            </th>
            <th scope="col" data-label="Token name">
              Token name
            </th>
            <th scope="col" data-label="Value">
              Value
            </th>
            <th scope="col" data-label="Use case">
              Use case
            </th>
            <th scope="col" data-label="Copy"></th>
          </tr>
        </thead>
        <tbody>
          <DesignSystemTable
            example={<p>Hello World</p>}
            tokenName="--rh-color-white"
            value="#ffffff"
            useCase="Lightest surface (light theme) or primary text (dark theme)"
            copy={`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">...</svg>`}
            jumpLink="#rh-color-white"
          />
        </tbody>
      </table>
    </div>
  );
}
