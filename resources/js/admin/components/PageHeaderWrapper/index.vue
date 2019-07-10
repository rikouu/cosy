<script>
import GridContent from '@/components/GridContent'

const prefixedClassName = 'page-header-wrap';

export default {
  name: 'PageHeaderWrapper',
  props: {

  },
  methods: {
    renderPageHeader () {
       const { content, extraContent } = this 
      if (!content && !extraContent) {
        return null;
      }
      return (
        <div class={`${prefixedClassName}-detail`}>
          <div class={`${prefixedClassName}-main`}>
            <div class={`${prefixedClassName}-row`}>
              {content && (
                <div class={`${prefixedClassName}-content`}>{content}</div>
              )}
              {extraContent && (
                <div class={`${prefixedClassName}-extraContent`}>
                  {extraContent}
                </div>
              )}
            </div>
          </div>
        </div>
      );
    },
    defaultPageHeaderRender () {
      return (
        // <RouteContext.Consumer>
        //   {value => {
        //     if (pageHeaderRender) {
        //       return pageHeaderRender({ ...props, ...value })
        //     }
        //     let pageHeaderTitle = title
        //     if (!title && title !== false) {
        //       pageHeaderTitle = value.title
        //     }
        //     return (
        //       <PageHeader
        //         {...value}
        //         title={pageHeaderTitle}
        //         {...restProps}
        //         footer={renderFooter(restProps)}
        //       >
        //         {renderPageHeader(content, extraContent)}
        //       </PageHeader>
        //     )
        //   }}
        // </RouteContext.Consumer>
      )
    }
  },
  render () {
    return (
      <div style={{ margin: '-24px -24px 0' }}>
        <div class={`${prefixedClassName}-page-header-warp`}>
          <GridContent>{defaultPageHeaderRender(props)}</GridContent>
        </div>
        {children ? (
          <GridContent>
            <div class={`${prefixedClassName}-children-content`}>
              {children}
            </div>
          </GridContent>
        ) : null}
      </div>

    )
  }
}
</script>

<style lang="less" scoped>
</style>
