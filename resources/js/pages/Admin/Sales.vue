<template>
    <v-toolbar color="transparent" title="Sales">
      <v-spacer></v-spacer>

      <AdminDialogAddSales/>
    </v-toolbar>
    <div class="table-responsive">
                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Facturación</th>
                        <th scope="col">Codigo de Venta</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Monto Total</th>
                        <th scope="col">Estado Factura</th>
                        <th scope="col">Vendido Por</th>
                        <th scope="col">Pagos</th>
                        <th scope="col">Imprimir</th>
                        <th scope="col">Actualizar</th>
                        <th scope="col">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <th>1234123</th>
                        <td>May 13, 2023</td>
                        <td>Pruebas Xxx</td>
                        <td>17000</td>
                        <td>
                            <v-badge inline color="warning" content="Debiendo"></v-badge>
                        </td>
                        <td>Admin Demo</td>
                        <td><v-btn icon="mdi-eye" size="x-small" color="success"></v-btn></td>
                        <td><v-btn icon="mdi-printer" size="x-small" color="warning"></v-btn></td>
                        <td><v-btn icon="mdi-file-edit" size="x-small" color="indigo-accent-3"></v-btn></td>
                        <td><v-btn icon="mdi-delete" size="x-small" color="red"></v-btn></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
  </template>