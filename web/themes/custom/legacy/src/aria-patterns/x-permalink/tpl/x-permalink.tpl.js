const path = require('path')

const xjs = require('extrajs-dom')

/**
 * @summary xPermalink renderer.
 * @param   {DocumentFragment} frag the template content with which to render
 * @param   {!Object} data the job data to display
 * @param   {string} data.id the fragment identifier to link to
 * @param   {string=} data.label human-readable text for `[aria-label]`
 * @param   {string=} data.text the textContent of the link
 */
function xPermalink_renderer(frag, data) {
  new xjs.HTMLAnchorElement(frag.querySelector('a'))
    .href(`#${data.id}`)
    .attr('aria-label', data.label || 'permalink')
    .textContent(data.text || '§') // &sect;
}

module.exports = xjs.HTMLTemplateElement
  .fromFileSync(path.join(__dirname, './x-permalink.tpl.html'))
  .setRenderer(xPermalink_renderer)
