<script>
import { Icon } from 'ant-design-vue'
export default {
  name: 'GlobalFooter',
  props: {
    links: {
      type: Array,
      default: () => {
        return []
      }
    }
  },
  render () {
    const { links } = this
    return (
      <footer class="global-footer">
        <div class="global-footer-links">
          {links.map(link => (
            <a
              href={link.path}
              key={link.key}
              title={link.key}
              target={link.blankTarget ? '_blank' : '_self'}
              href={link.href}
            >
              {link.icon && <Icon type={link.icon} />} {link.title}
            </a>
          ))}
        </div>
        <div class="global-footer-copyright">
          <slot name="copyright" />
        </div>
      </footer>
    )
  }
}
</script>

<style lang="less" scoped>
@import "./index";
</style>
