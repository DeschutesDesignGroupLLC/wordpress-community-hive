import { registerBlockType } from '@wordpress/blocks'
import metadata from './block.json'

registerBlockType(metadata.name, {
  edit: function () {
    return <p>Community Hive Follow Widget</p>
  }
})
