import axios from "axios"
import { useAuthStore } from "../stores/auth"

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
})

// Request interceptor to add auth token
api.interceptors.request.use(
  (config) => {
    const authStore = useAuthStore()
    if (authStore.token) {
      config.headers.Authorization = `Bearer ${authStore.token}`
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  },
)

// Response interceptor to handle auth errors
let authStore
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (!authStore) {
      authStore = useAuthStore()
    }
    if (error.response?.status === 401) {
      authStore.clearAuth()
      window.location.href = "/login"
    }
    return Promise.reject(error)
  },
)

export default api
