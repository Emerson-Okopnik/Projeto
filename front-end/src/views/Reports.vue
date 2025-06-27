<template>
  <div class="p-6">
    <div class="mb-8">
      <h1 class="text-2xl font-bold text-gray-900">Relatórios</h1>
      <p class="text-gray-600">Análises e estatísticas do sistema veterinário</p>
    </div>

    <!-- Date Range Filter -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
      <h2 class="text-lg font-medium text-gray-900 mb-4">Filtros</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Data Inicial</label>
          <input
            v-model="dateRange.start"
            type="date"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Data Final</label>
          <input
            v-model="dateRange.end"
            type="date"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
        </div>
        <div class="flex items-end">
          <button
            @click="loadReports"
            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
          >
            Gerar Relatórios
          </button>
        </div>
      </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Total de Consultas</dt>
                <dd class="text-lg font-medium text-gray-900">{{ summary.totalAppointments }}</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Consultas Concluídas</dt>
                <dd class="text-lg font-medium text-gray-900">{{ summary.completedAppointments }}</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Receita Total</dt>
                <dd class="text-lg font-medium text-gray-900">R$ {{ summary.totalRevenue }}</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
              </div>
            </div>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt class="text-sm font-medium text-gray-500 truncate">Novos Clientes</dt>
                <dd class="text-lg font-medium text-gray-900">{{ summary.newClients }}</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
      <!-- Appointments by Veterinarian -->
      <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Consultas por Veterinário</h3>
        <div v-if="appointmentsByVet.length > 0">
          <div class="space-y-4">
            <div v-for="vet in appointmentsByVet" :key="vet.veterinarian_id" class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                  <span class="text-sm font-medium text-indigo-600">
                    {{ vet.veterinarian_name.charAt(0) }}
                  </span>
                </div>
                <span class="text-sm font-medium text-gray-900">{{ vet.veterinarian_name }}</span>
              </div>
              <div class="flex items-center">
                <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                  <div 
                    class="bg-indigo-600 h-2 rounded-full" 
                    :style="{ width: `${(vet.total / Math.max(...appointmentsByVet.map(v => v.total))) * 100}%` }"
                  ></div>
                </div>
                <span class="text-sm text-gray-500">{{ vet.total }}</span>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="text-center py-8">
          <p class="text-gray-500">Nenhum dado disponível</p>
        </div>
      </div>

      <!-- Pets by Client -->
      <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Clientes com Mais Pets</h3>
        <div v-if="petsByClient.length > 0">
          <div class="space-y-4">
            <div v-for="client in petsByClient" :key="client.client_id" class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                  <span class="text-sm font-medium text-green-600">
                    {{ client.client_name.charAt(0) }}
                  </span>
                </div>
                <span class="text-sm font-medium text-gray-900">{{ client.client_name }}</span>
              </div>
              <div class="flex items-center">
                <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                  <div 
                    class="bg-green-600 h-2 rounded-full" 
                    :style="{ width: `${(client.total / Math.max(...petsByClient.map(c => c.total))) * 100}%` }"
                  ></div>
                </div>
                <span class="text-sm text-gray-500">{{ client.total }} pets</span>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="text-center py-8">
          <p class="text-gray-500">Nenhum dado disponível</p>
        </div>
      </div>
    </div>

    <!-- Appointments by Period Table -->
    <div class="bg-white shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
          Consultas por Período
        </h3>
        <div v-if="appointmentsByPeriod.length > 0" class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Data
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Total de Consultas
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Concluídas
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Canceladas
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Receita
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="period in appointmentsByPeriod" :key="period.date">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ formatDate(period.date) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ period.total }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ period.completed }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ period.cancelled }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  R$ {{ period.revenue }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else class="text-center py-8">
          <p class="text-gray-500">Nenhum dado disponível para o período selecionado</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { reportService } from '../services/reportService'
import { useToastStore } from '../stores/toast'

const toastStore = useToastStore()

const dateRange = ref({
  start: new Date(new Date().setDate(new Date().getDate() - 30)).toISOString().split('T')[0],
  end: new Date().toISOString().split('T')[0]
})

const summary = ref({
  totalAppointments: 0,
  completedAppointments: 0,
  totalRevenue: '0,00',
  newClients: 0
})

const appointmentsByVet = ref([])
const petsByClient = ref([])
const appointmentsByPeriod = ref([])
const loading = ref(false)

const loadReports = async () => {
  loading.value = true
  try {
    const [
      appointmentsByPeriodRes,
      appointmentsByVetRes,
      petsByClientRes
    ] = await Promise.all([
      reportService.getAppointmentsByPeriod(dateRange.value),
      reportService.getAppointmentsByVeterinarian(dateRange.value),
      reportService.getPetsByClient()
    ])

    appointmentsByPeriod.value = appointmentsByPeriodRes.data
    appointmentsByVet.value = appointmentsByVetRes.data
    petsByClient.value = petsByClientRes.data

    // Calculate summary
    const totalAppointments = appointmentsByPeriod.value.reduce((sum, period) => sum + period.total, 0)
    const completedAppointments = appointmentsByPeriod.value.reduce((sum, period) => sum + period.completed, 0)
    const totalRevenue = appointmentsByPeriod.value.reduce((sum, period) => sum + parseFloat(period.revenue || 0), 0)
    
    summary.value = {
      totalAppointments,
      completedAppointments,
      totalRevenue: totalRevenue.toFixed(2).replace('.', ','),
      newClients: 0
    }

  } catch (error) {
    toastStore.error('Erro ao carregar relatórios')
    console.error('Error loading reports:', error)
  } finally {
    loading.value = false
  }
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('pt-BR')
}

onMounted(() => {
  loadReports()
})
</script>
