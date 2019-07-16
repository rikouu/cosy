import request from '@/utils/request'

export function list (params) {
  return request({
    url: '/topic',
    method: 'get',
    params
  })
}

export function store (data) {
  return request({
    url: '/topic',
    method: 'post',
    data
  })
}

export function show (data) {
  const id = data.id
  return request({
    url: `/topic/${id}`,
    method: 'get',
    data
  })
}

export function update (id, data) {
  delete data['id']
  return request({
    url: `/topic/${id}`,
    method: 'post',
    data
  })
}

export function destroy (id) {
  return request({
    url: `/topic/${id}`,
    method: 'delete'
  })
}
