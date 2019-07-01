import {notification} from 'ant-design-vue'
import axios from 'axios'

const axiosRequestConfig = {
  baseURL: '/prism-api', // api 的 base_url
  timeout: 5000, // 请求超时时间
  withCredentials: true // 携带cookie信息
};

const axiosInstance = axios.create(axiosRequestConfig)

// request拦截器
axiosInstance.interceptors.request
  .use((request) => {
      const token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
      request.headers.common['Authorization'] = token;
    }
    return request
  },
  (error) => {
    return Promise.reject(error)
  });

axiosInstance.interceptors.response.use(
  (response) => {
    return response
  },
  (error) => {
    switch (error.response.status) {
      case 401: {
        location.reload();
        break
      }
      case 400:
        return notification.error({
          message: '错误',
          description: error.response.data.error
        });
      default: break;
    }
    return Promise.reject(error)
  });

export default function request (config) {
  return axiosInstance(config)
}
