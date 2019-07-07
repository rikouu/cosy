<script>
import { Dropdown } from 'ant-design-vue'
const HeaderDropdown = ({
  overlayClassName: cls,
  ...restProps
}) => {
  // eslint-disable-next-line no-unused-expressions
  console.log(cls)
  return (<Dropdown overlayClassName={'container ' + String(cls)} {...restProps}/>)
}
export default HeaderDropdown
</script>
