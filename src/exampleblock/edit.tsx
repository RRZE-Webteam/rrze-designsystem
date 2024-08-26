import {
  TextControl,
  PanelBody,
  __experimentalText as Text,
  __experimentalSpacer as Spacer,
  __experimentalVStack as VStack,
  CheckboxControl,
} from "@wordpress/components";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import apiFetch from "@wordpress/api-fetch";
import { useState, useEffect } from "@wordpress/element";
import { DesignSystemTable } from "../components/DesignSystemTable";

interface EditProps {
  attributes: {
    style?: string;
    color: string;
    textColor?: string;
    borderColor?: string;
    title?: string;
    selectedColorCategories: { [key: string]: boolean }; // Selected color categories
    groupedColors: { [key: string]: ColorSystem[] }; // Grouped colors
    selectedTypographyCategories: { [key: string]: boolean }; // Selected typography categories
    groupedTypography: { [key: string]: TypographySystem[] }; // Grouped typography
  };
  setAttributes: (attributes: Partial<EditProps["attributes"]>) => void;
  clientId: string;
  context: { [key: string]: any };
  blockProps: any;
}

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

interface TypographySystem {
  id: number;
  title: string;
  font_family: string;
  font_size: string;
  font_weight: string;
  line_height: string;
  letter_spacing: string;
  color: string;
  category: Category[];
}

export default function Edit({
  blockProps,
  attributes,
  setAttributes,
}: EditProps) {
  const props = useBlockProps();

  const [colorsystems, setColorsystems] = useState<ColorSystem[]>([]);
  const [typographysystems, setTypographySystems] = useState<
    TypographySystem[]
  >([]);

  useEffect(() => {
    apiFetch({ path: "/colorsystem/v1/data" })
      .then((data: ColorSystem[]) => {
        setColorsystems(data);
        groupColorsByCategory(data);
      })
      .catch((error) => {
        console.error("Error fetching color systems:", error);
      });

    apiFetch({ path: "/typographysystem/v1/data" })
      .then((data: TypographySystem[]) => {
        console.log("Fetched typography systems:", data); // Debug log
        setTypographySystems(data);
        groupTypographyByCategory(data);
      })
      .catch((error) => {
        console.error("Error fetching typography systems:", error);
      });
  }, []);

  const groupColorsByCategory = (data: ColorSystem[]) => {
    const groups: { [key: string]: ColorSystem[] } = {};

    data.forEach((colorSystem) => {
      colorSystem.category.forEach((cat) => {
        if (!groups[cat.name]) {
          groups[cat.name] = [];
        }
        groups[cat.name].push(colorSystem);
      });
    });

    console.log("Grouped colors by category:", groups); // Debug log

    setAttributes({ groupedColors: groups });

    if (!attributes.selectedColorCategories) {
      const initialCategories = Object.keys(groups).reduce(
        (acc, categoryName) => {
          acc[categoryName] = true;
          return acc;
        },
        {} as { [key: string]: boolean }
      );
      setAttributes({ selectedColorCategories: initialCategories });
    }
  };

  const groupTypographyByCategory = (data: TypographySystem[]) => {
    const groups: { [key: string]: TypographySystem[] } = {};

    data.forEach((typographySystem) => {
      typographySystem.category.forEach((cat) => {
        if (!groups[cat.name]) {
          groups[cat.name] = [];
        }
        groups[cat.name].push(typographySystem);
      });
    });

    console.log("Grouped typography by category:", groups); // Debug log

    setAttributes({ groupedTypography: groups });

    if (!attributes.selectedTypographyCategories) {
      const initialCategories = Object.keys(groups).reduce(
        (acc, categoryName) => {
          acc[categoryName] = true;
          return acc;
        },
        {} as { [key: string]: boolean }
      );
      setAttributes({ selectedTypographyCategories: initialCategories });
    }
  };

  const onColorCategoryChange = (categoryName: string, isChecked: boolean) => {
    const updatedCategories = {
      ...attributes.selectedColorCategories,
      [categoryName]: isChecked,
    };
    setAttributes({ selectedColorCategories: updatedCategories });
  };

  const onTypographyCategoryChange = (
    categoryName: string,
    isChecked: boolean
  ) => {
    const updatedCategories = {
      ...attributes.selectedTypographyCategories,
      [categoryName]: isChecked,
    };
    setAttributes({ selectedTypographyCategories: updatedCategories });
  };

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
      <InspectorControls>
        <PanelBody
          title={__("Color Palette", "rrze-designsystem")}
          initialOpen={true}
        >
          <Spacer>
            <Text>
              {__("Select the color palettes to display", "rrze-designsystem")}
            </Text>
          </Spacer>
          <VStack>
            {Object.keys(attributes.groupedColors || {}).map((categoryName) => (
              <CheckboxControl
                key={categoryName}
                label={categoryName}
                checked={
                  attributes.selectedColorCategories
                    ? attributes.selectedColorCategories[categoryName]
                    : true
                }
                onChange={(isChecked) =>
                  onColorCategoryChange(categoryName, isChecked)
                }
              />
            ))}
          </VStack>
        </PanelBody>

        <PanelBody
          title={__("Typography Settings", "rrze-designsystem")}
          initialOpen={true}
        >
          <Spacer>
            <Text>
              {__("Select the typography settings to display", "rrze-designsystem")}
            </Text>
          </Spacer>
          <VStack>
            {Object.keys(attributes.groupedTypography || {}).map(
              (categoryName) => (
                <CheckboxControl
                  key={categoryName}
                  label={categoryName}
                  checked={
                    attributes.selectedTypographyCategories
                      ? attributes.selectedTypographyCategories[categoryName]
                      : true
                  }
                  onChange={(isChecked) =>
                    onTypographyCategoryChange(categoryName, isChecked)
                  }
                />
              )
            )}
          </VStack>
        </PanelBody>
      </InspectorControls>

      <div>
        <h3>Available Color Systems</h3>
        {Object.keys(attributes.groupedColors || {}).length > 0 ? (
          Object.keys(attributes.groupedColors)
            .filter((categoryName) =>
              attributes.selectedColorCategories
                ? attributes.selectedColorCategories[categoryName]
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

        <h3>Available Typography Systems</h3>
        {Object.keys(attributes.groupedTypography || {}).length > 0 ? (
          Object.keys(attributes.groupedTypography)
            .filter((categoryName) =>
              attributes.selectedTypographyCategories
                ? attributes.selectedTypographyCategories[categoryName]
                : true
            )
            .map((categoryName) => (
              <div key={categoryName}>
                <h4>{categoryName}</h4>
                <ul className="rrze-designsystem-typographylist">
                  {attributes.groupedTypography[categoryName].map((item) => (
                    <li key={item.id}>
                      <span
                        style={{
                          fontFamily: item.font_family,
                          fontSize: item.font_size,
                          fontWeight: item.font_weight,
                          lineHeight: item.line_height,
                          letterSpacing: item.letter_spacing,
                          color: item.color,
                        }}
                      >
                        {item.title}
                      </span>{" "}
                      <br />
                      <span className="rrze-designsystem-fontdetails">
                        {item.font_family}, {item.font_size}, {item.font_weight}
                        , {item.line_height}, {item.letter_spacing}
                      </span>
                    </li>
                  ))}
                </ul>
              </div>
            ))
        ) : (
          <p>No typography systems found.</p>
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
