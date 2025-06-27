<template>
  <div class="p-6">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Clientes</h1>
        <p class="mt-2 text-sm text-gray-700">
          Lista de todos os clientes cadastrados no sistema.
        </p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <button
          @click="showCreateModal = true"
          type="button"
          class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
        >
          Novo Cliente
        </button>
      </div>
    </div>

    <!-- Search -->
    <div class="mt-6">
      <div class="max-w-md">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Buscar clientes..."
          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          @input="debouncedSearch"
        />
      </div>
    </div>

    <!-- Clients Table -->
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nome
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Telefone
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Pets
                  </th>
                  <th class="relative px-6 py-3">
                    <span class="sr-only">Ações</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="client in clients" :key="client.id">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ client.name }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ client.email || '-' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ client.phone }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ client.pets_count }} pets
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <router-link
                      :to="`/clients/${client.id}`"
                      class="text-indigo-600 hover:text-indigo-900 mr-4"
                    >
                      Ver
                    </router-link>
                    <button
                      @click="editClient(client)"
                      class="text-indigo-600 hover:text-indigo-900 mr-4"
                    >
                      Editar
                    </button>
                    <button
                      @click="deleteClient(client)"
                      class="text-red-600 hover:text-red-900"
                    >
                      Excluir
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div v-if="pagination && pagination.total && pagination.per_page && pagination.total > pagination.per_page" class="mt-6">
      <nav class="flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
          <button
            @click="loadClients(pagination.current_page - 1)"
            :disabled="pagination.current_page === 1"
            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
          >
            Anterior
          </button>
          <button
            @click="loadClients(pagination.current_page + 1)"
            :disabled="pagination.current_page === pagination.last_page"
            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
          >
            Próximo
          </button>
        </div>
      </nav>
    </div>

    <!-- Create/Edit Modal -->
    <ClientModal
      v-if="showCreateModal || showEditModal"
      :client="selectedClient"
      :is-edit="showEditModal"
      @close="closeModal"
      @saved="handleClientSaved"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { clientService } from '../services/clientService'
import { useToastStore } from '../stores/toast'
import ClientModal from '../components/ClientModal.vue'
import { useDebounceFn } from '@vueuse/core'

const toastStore = useToastStore()

const clients = ref([])
const pagination = ref({})
const searchQuery = ref('')
const loading = ref(false)

const showCreateModal = ref(false)
const showEditModal = ref(false)
const selectedClient = ref(null)

const loadClients = async (page = 1) => {
  loading.value = true
  try {
    const params = {
      page,
      search: searchQuery.value
    }
    const response = await clientService.getClients(params)
    clients.value = response.data.data
    pagination.value = response.data.meta
  } catch (error) {
    toastStore.error('Erro ao carregar clientes')
  } finally {
    loading.value = false
  }
}

const debouncedSearch = useDebounceFn(() => {
  loadClients()
}, 500)

const editClient = (client) => {
  selectedClient.value = client
  showEditModal.value = true
}

const deleteClient = async (client) => {
  if (confirm(`Tem certeza que deseja excluir o cliente ${client.name}?`)) {
    try {
      await clientService.deleteClient(client.id)
      toastStore.success('Cliente excluído com sucesso!')
      loadClients()
    } catch (error) {
      toastStore.error('Erro ao excluir cliente')
    }
  }
}

const closeModal = () => {
  showCreateModal.value = false
  showEditModal.value = false
  selectedClient.value = null
}

const handleClientSaved = () => {
  closeModal()
  loadClients()
}

onMounted(() => {
  loadClients()
})
</script>
