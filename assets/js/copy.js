document.addEventListener("DOMContentLoaded", function () {
  // Function to copy text to clipboard with fallback for Safari and older browsers
  function copyToClipboard(text) {
    // Check if the Clipboard API is available
    if (navigator.clipboard && navigator.clipboard.writeText) {
      // Use the Clipboard API if available
      navigator.clipboard.writeText(text).then(function () {
        alert("Copied to clipboard: " + text);
      }).catch(function (error) {
        console.error("Copy failed", error);
      });
    } else {
      // Fallback for Safari and older browsers
      const textarea = document.createElement('textarea');
      textarea.value = text;
      textarea.style.position = 'fixed';  // Prevent scrolling to bottom of page in Microsoft Edge
      document.body.appendChild(textarea);
      textarea.focus();
      textarea.select();
      
      try {
        document.execCommand('copy');
        alert("Copied to clipboard: " + text);
      } catch (error) {
        console.error("Fallback copy failed", error);
      }
      
      document.body.removeChild(textarea);
    }
  }

  // Copy content of <code> tags
  document.querySelectorAll("table.rrze-designsystem td code").forEach(function (el) {
    el.addEventListener("click", function () {
      copyToClipboard(el.textContent);
    });
  });

  // Copy CSS variable syntax using data-copy attribute
  document.querySelectorAll("rrze-copy-button").forEach(function (button) {
    button.addEventListener("click", function () {
      var copyValue = button.getAttribute("data-copy");
      copyToClipboard(copyValue);
    });
  });
});
