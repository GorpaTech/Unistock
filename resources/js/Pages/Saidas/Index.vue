<template class="dark">
    <Layout>
        <Head title="Saídas" />
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search" required="">
                                </div>
                            </form>
                        </div>
                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <!-- FORMULÁRIO CRIAÇÃO FORNECEDOR -->
                            <button type="button" @click="openAddModal"
                                class="flex items-center justify-center text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="w-[20px] h-[20px] text-white-800 dark:text-white mr-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 12h14m-7 7V5" />
                                </svg>
                                Add Saída
                            </button>
                            <el-dialog class="dark relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
                                        v-model="form.openModal"
                                        :title="form.titulo"
                                        width="40%"
                            >
                                <template #default>
                                    <div class="flex flex-col h-full">
                                        <div class="flex-grow overflow-auto p-4">
                                            <form @submit.prevent="form.editMode ? update() : create()">
                                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                                    <div>
                                                        <label for="nomeProduto"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produto</label>
                                                            <select v-model="form.id_produto" id="produto" :disabled="form.showMode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                <option v-for="produto in produtos" :key="produto.id" :value="produto.id">{{ produto.name }}</option>
                                                            </select>
                                                            <div v-if="form.errors.id_produto" class="mt-2 text-danger" v-text="form.errors.id_produto"></div>
                                                    </div>
                                                    <div>
                                                        <label for="codigo"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
                                                        <input v-model="form.codigo" type="integer" name="codigo" id="codigo" :disabled="form.showMode"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Código da Entrada">
                                                        <div v-if="form.errors.codigo" class="mt-2 text-danger" v-text="form.errors.codigo"></div>
                                                    </div>
                                                    <div>
                                                        <label for="quantidade"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade</label>
                                                        <input v-model="form.quantidadeProduto" type="integer" name="quantidade" id="quantidade" :disabled="form.showMode"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="00">
                                                        <div v-if="form.errors.quantidadeProduto" class="mt-2 text-danger" v-text="form.errors.quantidadeProduto"></div>
                                                    </div>
                                                    <div>
                                                        <label for="valorTotal"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Custo Total</label>
                                                        <input v-model="form.valorTotal" type="float" name="valorTotal" id="valorTotal" :disabled="form.showMode"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            :placeholder="(form.id_produto ? (form.quantidadeProduto) * (produtos[(form.id_produto)-1].precoUnitario) : 0)">
                                                        <div v-if="form.errors.valorTotal" class="mt-2 text-danger" v-text="form.errors.valorTotal"></div>
                                                    </div>
                                                    <div>
                                                        <label for="data"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                                                        <input v-model="form.dataSaida" type="date" name="data" id="data" :disabled="form.showMode"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        >
                                                        <div v-if="form.errors.dataSaida" class="mt-2 text-danger" v-text="form.errors.dataSaida"></div>
                                                    </div>
                                                </div>

                                                <div class="flex justify-center">
                                                    <button v-if="form.addMode" type="submit"
                                                        class="text-white inline-flex  items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Adicionar Saída
                                                    </button>
                                                    <button v-if="form.editMode" type="submit" :disabled="form.showMode"
                                                        class="text-white inline-flex  items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Editar Saída
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </template>
                            </el-dialog>
                            <!-- END FORMULARIO -->
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Filter
                                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                </button>
                                <div id="filterDropdown"
                                    class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose brand</h6>
                                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                        <li class="flex items-center">
                                            <input id="apple" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="apple"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple
                                                (56)</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="fitbit" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="fitbit"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft
                                                (16)</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="razor" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="razor"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Razor
                                                (49)</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="nikon" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="nikon"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nikon
                                                (12)</label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="benq" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="benq"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">BenQ
                                                (74)</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Nome</th>
                                    <th scope="col" class="px-4 py-3">Código</th>
                                    <th scope="col" class="px-4 py-3">Quantidade</th>
                                    <th scope="col" class="px-4 py-3">Custo Total</th>
                                    <th scope="col" class="px-4 py-3">Data</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="saida in saidas" :key="saida.id"
                                    class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a @click="openShowModal(saida, produtos[(saida.id_produto)-1].name)" class="cursor-pointer">{{ produtos[(saida.id_produto)-1].name }}</a></th>
                                    <td class="px-4 py-3">{{ saida.codigo }}</td>
                                    <td class="px-4 py-3">{{ saida.quantidadeProduto }}</td>
                                    <td class="px-4 py-3">{{ formatarValor(saida.valorTotal) }}</td>
                                    <td class="px-4 py-3">{{ saida.dataSaida }}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button :id="`${saida.id}-button`" :data-dropdown-toggle="`${saida.id}`"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div :id="`${saida.id}`"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                :aria-labelledby="`${saida.id}-button`">
                                                <li>
                                                    <a @click="openShowModal(saida, produtos[(saida.id_produto)-1].name)"
                                                        class="cursor-pointer block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                </li>
                                                <li>
                                                    <a @click="openEditModal(saida, produtos[(saida.id_produto)-1].name)"
                                                        class="cursor-pointer block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a @click="deleteSaida(saida)"
                                                    class="cursor-pointer block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Layout from '../../Shared/Layout.vue';

defineProps({
    saidas: Array,
    produtos: Array
})

const openAddModal = () => {
    form.reset();
    form.titulo = "Adicionar Saida";
    form.addMode = true;
    form.editMode = false;
    form.showMode = false;
    form.openModal = true;
}

const openEditModal = (saida, nomeProduto) => {
    form.reset();
    form.titulo = 'Editar Saida ' + nomeProduto;
    form.id = saida.id;
    form.codigo = saida.codigo;
    form.quantidadeProduto = saida.quantidadeProduto;
    form.valorTotal = saida.valorTotal;
    form.dataSaida = saida.dataSaida;
    form.id_produto = saida.id_produto;

    form.addMode = false;
    form.editMode = true;
    form.showMode = false;
    form.openModal = true;
}

const openShowModal = (saida, nomeProduto) => {
    form.reset();
    form.titulo = 'Visualizar Saida ' + nomeProduto;
    form.id = saida.id;
    form.codigo = saida.codigo;
    form.quantidadeProduto = saida.quantidadeProduto;
    form.valorTotal = saida.valorTotal;
    form.dataSaida = saida.dataSaida;
    form.id_produto = saida.id_produto;

    form.addMode = false;
    form.editMode = false;
    form.showMode = true;
    form.openModal = true;
}

const form = useForm({
    id: null,
    codigo: null,
    quantidadeProduto: null,
    valorTotal: null,
    dataSaida: null,
    id_produto: null,
    titulo: '',
    openModal: false,
    addMode: false,
    editMode: false,
    showMode: false,
})


function create() {
    form.post('/saidas', {
        onSuccess: () => {
            form.reset();
            form.openModal = false;
        },
        onError: () => {
            setTimeout(() => {
                form.clearErrors();
            }, 5000);
        }
    });
}

function update() {
    form.put('/saidas/' + form.id, {
        onFinish: () => {
            form.reset();
            form.openModal = false;
        },
        onError: () => {
            setTimeout(() => {
                form.clearErrors();
            }, 5000);
        }
    });
}

function deleteSaida(saida) {
    form.delete('saidas/' + saida.id);
}

function formatarValor(valor) {
    return new Intl.NumberFormat('pt-BR', {
       style: 'currency',
        currency: 'BRL'
    }).format(valor);
}

</script>

<style lang="scss" scoped></style>
