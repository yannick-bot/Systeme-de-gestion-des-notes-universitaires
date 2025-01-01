import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import { InertiaLink } from '@inertiajs/inertia-react'
import { Inertia } from '@inertiajs/inertia'


interface EC {
    id: number;
    code: string,
    nom: string,
    coefficient: number,
    ue_id: number
}

interface Data {
    ecs: EC[]
}

export default function Index({ ecs }: Data) {

    console.log(typeof(ecs))
    const handleDelete = (id: number) => { Inertia.delete(route('EC.destroy', id)); };

    return (
        <AuthenticatedLayout
            header={
                <div className='flex justify-between'>
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        EC
                    </h2>
                    <InertiaLink href={route('EC.create')}>
                        <i className="ri-add-box-fill" style={{fontSize: '30px'}}></i>
                    </InertiaLink>
                </div>
            }
        >
            <Head title="UE_List" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-5">
                        <table cellPadding="50" border={1} align="center">
                            <thead>
                                <tr>
                                    <th>Code EC</th>
                                    <th>Nom</th>
                                    <th>Coefficient</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                {
                                    ecs.map(ec =>
                                       (
                                            <tr key={ec.id}>
                                                <td className='text-center'>{ec.code}</td>
                                                <td className='text-center'>{ec.nom}</td>
                                                <td className='text-center'>{ec.coefficient}</td>
                                                <td className='flex'>

                                                    <button className="rounded-xl p-2 border-2 ml-2"><a href={route('EC.edit', ec.id)}>EDIT</a></button>
                                                    <button onClick={() => handleDelete(ec.id)} className="rounded-xl p-2 border-2 ml-2" > DELETE </button>
                                                </td>
                                            </tr>
                                        )
                                    )
                                }

                            </tbody>
            </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}



